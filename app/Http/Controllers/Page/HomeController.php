<?php

namespace xatbot\Http\Controllers\Page;

use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use xatbot\Models\Log;
use xatbot\Models\Bot;
use xatbot\Utilities\IPC;
use xatbot\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bot = Bot::find(Session('onBotEdit'));

        if ($bot) {
            $logs = Log::where([
                ['chatid', '=', $bot->chatid],
                ['created_at', '>=', Carbon::now()->subDay()]
            ])->select('typemessage', DB::raw('count(*)'))->groupBy('typemessage')->get()->toArray();

            $logs = array_column($logs, 'count', 'typemessage');

            if ($bot->botStatus->id == 1) {
                IPC::init();
                if (IPC::connect(strtolower($bot->server->name) . '.sock') == true) {
                    IPC::write(sprintf("%s %d", 'users_count', Session('onBotEdit')));
                    $packet = IPC::read(1024);
                }
                IPC::close();
            }
            $logs[6] = $packet ?? 'NaN';
        } else {
            for ($i = 0; $i < 6; $i++) {
                $logs[$i] = 'NaN';
            }
        }


        $bots = \Auth::user()->bots;
        return view('page.home')
                ->with('logs', $logs)
                ->with('bots', $bots);
        ;
    }
}
