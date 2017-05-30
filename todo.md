# TODO list

### Features
* [ ] Share a bot between users, with roles?

### Pages
* [ ] Landing page
* [ ] Chat logs
* [ ] Chat statitics (Users online, Messages sent last 24h, Commands sent last 24h, Actions last 24h)
* [ ] Hangman words
* [ ] Typerace sentences
* [ ] Commands (option GET chat/chatid to get minranks for a given chat)
* [ ] Get Premium (Videos in different languages)
* [ ] Ocean Staff (With ranks)
* [ ] Servers status

### Staff panel
* [ ] Add userslist, search user via regname/xatid/username/email, view user and its bots owned, change his roles
* [ ] Add botslist, search bot via chat/chatid, be able to edit a bot to help users
* [ ] Add commandslist, be able to add/edit a command (Only admin)
* [ ] Add serverslist, be able to add/edit a server (Only admin)
* [ ] Add ticketslist, be able to reply/close tickets

### Translation system
[Source1](https://github.com/caouecs/Laravel-lang)
[Source2](https://github.com/Waavi/translation)
* [ ] Panel to manage languages and translations
OR doing it manually:
[Source3](https://laravel.com/docs/5.4/localization)
* [ ] Add language column into users table
* [ ] Dropdown menu to change language

### Userinfo
* [ ] Import old table to the new database
* [ ] Create the page

### Migration old to new website
Users will have to register again to be sure their information are 100% clean.
A mail will be sent to them to verify their email.
Once they clicked on the link sent, they will have to create a bot (need to have the chat password to confirm they own the chat).
All data (bot settings, staff list, snitch list, autotemp list, bot's powers, responses, badwords, links, hangman words, aliases) will be insert in the new database, they will have to re-do their minranks and bot's messages...