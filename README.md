# Influence Networks

[Influence Networks](http://influencenetworks.org) is an open-source, collaborative directory of relationships between people, institutions and companies. Each relation has its own level of trustworthiness, so that facts can be distinguished from noise. 

## Issue report ##

Go on [https://www.pivotaltracker.com/projects/336991](https://www.pivotaltracker.com/projects/336991) to report a bug.

## How does it work? ##

There was a need for a network analysis tool who could be used by journalists and that be both open and reliable. Influence Networks aims at solving this problem. The platform allows for anyone to add a ‘relationship' in the database (though the "add a relation" tab). The bit of information the user inputs is given a "rumor" status as long as its reliability has not been assessed by another user.

The "review a relation" tab allows for vetting the credibility of relations added by others. The user who validates can rate the relation on a scale going from "rumor" to "established fact". The rating the relation receives also depends on the trust level of the user who validates it.

Let's take an example. Mathias registers on the platform. He starts with a trust level of 1 out of 5. He adds a valid piece of information, complete with source. The information is validated by a user who has a trust level of 5 out of 5. The information is then given the status of "established fact" and Mathias' trust level increases by 0.5.

Mathias then adds another bit of valid information, but the information is validated by George, who has a trust level of only 1. This time, since we have no way of knowing about George's trustworthiness, the information's status is upped just above "rumor", but not much more.

As of today, right after launch, the database contains only a few ‘relationships'. We will build a batch-add feature in the coming months, so that users can, for instance, upload a meeting's attendance list. What's more, the entities (people and organizations) that can be described in Influence Networks all come from Freebase, which is like a machine-readable Wikipedia. That means that if the entity you are looking for is not featured on Influence Networks, you can go to Freebase and add it there. In the coming months, we will add a feature to do just that within the Influence Networks interface.

## How to install it ##

1. Download the last stable version of [Influence Networks from Github](https://github.com/Pirhoo/Influence-Networks/zipball/v1.0) (v1.0);
2. Extract your archive in the execution directory;
3. Check _PATH/appinc/template/\_compiled_ and _PATH/appinc/template/\_common_ are allowed for reading and writing:
4. Import the two SQL dumps from _PATH/config/_ directory in your MySQL database (_CREATE-*.sql_  then _INSERT-*.sql_);
5. Configure database login on _PATH/config/config.init.php_ file (and some other things...).

## MIT License ##

This programme is under *MIT License*. Acording to [Wikipedia](http://en.wikipedia.org/wiki/MIT_License), "the MIT License is a free software license originating at the Massachusetts Institute of Technology (MIT). It is a permissive license, meaning that it permits reuse within proprietary software on the condition that the license is distributed with that software. The license is also GPL-compatible, meaning that the GPL permits combination and redistribution with software that uses the MIT License."

## About Influence Networks ##

Influence Networks was born out of a collaboration between [OWNI.fr](http://owni.fr), [Transparency International](http://transparency.org/), [Zeit Online](http://www.zeit.de/index) and [Obsweb](http://obsweb.net/) (Metz University).
