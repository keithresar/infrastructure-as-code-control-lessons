# Git Introduction

Version control is a key component to successfully supporting an infrastructure as code culture.
Git is a decentralized VCS which truly enables a new flexibility in collaboration that was never
fully available with more traditional Enterprise VCS solutions such as cvs, svn, tfs, and others.

Git is an incredibly powerful tool and it is grown substantially since Linux Torvalds first wrote it
during a weekend of programming back in 2005.  Many companies have been established to add value
throughout the git lifecycle.  

As this is merely an introduction rather than an in-depth review, we'll focus on some specific and
most commonly used functionality.

<hr>

###  Exercise 2.19 - Exploring a git playground

This entire exercise will be completed inside your terminal.

Please change to your home directory outside of the project space where you've been working so far.

```
> cd
```

**Creating a new repository**

Git operates locally and its entire database exists within you the project's root directory.
This allows you to have multiple different projects, each residing in their own directory.

To create a new git repository called `test-repo` issue the following command:

```
> git init test-repo
```

If you change into the `test-repo` directory and explore you'll notice a number of files created
under a hidden `.git/` subdirectory.  Git stores its entire database locally inside of this directory.

```
> cd test-repo
> find test-repo
```


**Adding and staging files**

What good is version control without any files?  Let's create some files that we'll work with through
the next few exercises.  

```
> touch file1 
```

As of now git doesn't know or manage these files - as can be seen by running the `git status` command.

```
> git status 
# On branch master
#
# Initial commit
#
# Untracked files:
#   (use "git add <file>..." to include in what will be committed)
#
#    file1
nothing added to commit but untracked files present (use "git add" to track)
```

We can stage these files for commit by using the `git add` command

```
> git add file1 
```

See how the status output changes after staging those files.


**Committing changes**

The staged files are not yet immutably locked in the git VCS database, that can only be done
by commiting them.  Use the command below to make your commit and append the commit message 
"my first commit".

```
> git commit -m 'my first commit'
```


**Creating branches**

Nearly every VCS has some form of branching support. Branching means you diverge from the main line 
of development and continue to do work without messing with that main line. In many VCS tools, this 
is a somewhat expensive process, often requiring you to create a new copy of your source code directory, 
which can take a long time for large projects.

Some people refer to Git’s branching model as its “killer feature,” and it certainly sets Git apart in 
the VCS community. Why is it so special? The way Git branches is incredibly lightweight, making branching 
operations nearly instantaneous, and switching back and forth between branches generally just as fast. Unlike 
many other VCSs, Git encourages workflows that branch and merge often, even multiple times in a day. 
Understanding and mastering this feature gives you a powerful and unique tool and can entirely change the way 
that you develop.

Review this link on [git branches in a nutshell](https://git-scm.com/book/en/v2/Git-Branching-Branches-in-a-Nutshell)
for a visual explanation of everything that's happening here.

Right now we are on the default `MASTER` branch.  To create a new branch which is a snapshot of master in which
we can play, use the `git branch` command.

```
> git branch dev
> git checkout dev
```

So far none of your files have changed.  If you enter the `git branch -a` command you'll see a list of all the branches
that currently exist in your repo.

```
> git branch -a
* dev
  master
```

Create another file name `file_from_dev`, add it to VCS, and commit it using the commands from previous sections.

Look at your directory listing - you should see your new file:

```
> ls -l
total 0
-rw-r--r--. 1 root root 0 Feb 28 20:34 file1
-rw-r--r--. 1 root root 0 Feb 28 20:45 file_from_dev
```

Now change back to your master branch and see what's happened to your files:

```
> git checkout MASTER
> ls -l 
-rw-r--r--. 1 root root 0 Feb 28 20:34 file1
```

The file created while you were in the `dev` branch is no longer visible within the `MASTER` branch.


**Merging changes**

Changes made in one branch can be merged into any other branch.  When projects have many long-lived
branches with highly divergent and even conflicting changes this can be challenging.  To make this
easier there are many tools availabel which help visualize changes and can apply different algorithmic
merging strategies.

As this is a lab environment, and we have no conflicting changes, merging is far easier.

Merge `dev` into `MASTER` using the `git merge` command.

```
> git merge dev
> ls -l 
```

The file you modified in dev should now be visible.


**Cleanup**


When you complete the exercise please change back to your project directory

```
> cd /projects/infrastructure-as-code
```

###  Exercise 2.20 - Configuring access to Gitlab

- logging into browser
- uploading ssh key


###  Exercise 2.20 - Working with Git in CHE

- uploading ssh key
- adding remotes
- first commit
- push
- verifying in web browser



### 📗 Resources

 - [git cheat sheet](https://services.github.com/on-demand/downloads/github-git-cheat-sheet.pdf)
 - [git branches in a nutshell](https://git-scm.com/book/en/v2/Git-Branching-Branches-in-a-Nutshell)

