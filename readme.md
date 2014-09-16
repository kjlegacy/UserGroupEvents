## Laravel belongsToMany

During one of my Laravel 4 projects, I was required to construct a feature that would allow the website administrator to:

1. Add a user
2. Add a subgroup
3. Add a group
4. Add an event

5. then take the user(s) and place them in a subgroup
6. take the subgroup(s) and place them in a bigger group
7. take the group(s) and place them to an event

All of the time the users can be added and removed,
the subgroups can be added and removed and
the groups can be added and removed.

The main feature would be showing which user goes to which event with which subgroup and what group would that subgroup belong to.

in short: User->Subgroup->Group->Event

* also incase only a certain subgroup joined the event and not the whole group I needed to give out the possibility as
User->Subgroup->Event

Then the administrator had to see if the user is attending with the status symbol.

-----------------------------

As I was searching the web for database normalization and design for laravel. I saw a lot of people having the same problems but I didn't see much help from stackoverflow or from Laravels documentation (at least at the time I did not see how to apply the logic). Finally I found a fantastic guide on pivot tables from Scotch.io.

link: http://scotch.io/tutorials/php/a-guide-to-using-eloquent-orm-in-laravel

It helped me alot along the way to build something raw and simple with the pivot tables.

It is by no means a perfect guide but I hope someone finds it helpful.

Big thanks to Scotch.io and keep learning, keep developing.

KJ



