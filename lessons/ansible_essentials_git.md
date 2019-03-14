# Git Introduction

Version control is a key component to successfully supporting an infrastructure as code culture.
Git is a decentralized VCS (version control system) which truly enables a new flexibility in 
collaboration that was never fully available with more traditional Enterprise VCS solutions such as 
cvs, svn, tfs, and others.

Git is an incredibly powerful tool and it has grown substantially since Linus Torvalds first wrote it
during a weekend of programming back in 2005.  Many companies have been established to add value
throughout the git lifecycle.  

As this is merely an introduction rather than an in-depth review, we'll focus on some specific and
most commonly used functionality.

<hr>

###  Exercise 2.19 - Exploring a git playground

This entire exercise will be completed inside your terminal.

Please change to your home directory outside of the project space where you've been working so far.
A shorcut to get there is to simply type `cd` and enter.

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

If you explore the `test-repo` directory you'll notice a number of files created
under a hidden `.git/` subdirectory.  Git stores its entire database locally inside of this directory.

```
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


**Extra Credit**

If time permits try to exercise some more complicated changes and merges.  For example, what happens if
you:

* Create a new branch, modify the same file in multiple branches, and try to merge them
* Create a two branches off `MASTER` - `dev2` and `dev3`.  Create a file in `dev2` and merge it into `dev3`.
  This is an example of merging from unrelated (sibling) branches.


**Cleanup**


When you complete the exercise please change back to your project directory

```
> cd /projects/infrastructure-as-code-lab
```


###  Exercise 2.20 - Configuring access to Gitlab from CHE

**CHE Setup**

The true power of git can only be realized when collaborating beyond the local filesystem, which is
something we haven't yet explored.

Our lab environment has a shared Gitlab server and everyone has a login to this asset.  We need to
configure your access to Gitlab using a public key generated by CHE.

Start clicking on the **Profile -> Preferences** menu in CHE.

<img src="/images/ansible_essentials/che_preferences_menu.png" style="margin-left:2em;max-width:90%;">

Inside the preferences dialogue start by navigating to the **Git -> Committer**  section.  Enter a name
any email (this can be dummy information).

<img src="/images/ansible_essentials/che_git.png" style="margin-left:2em;max-width:90%;">

Now navigate to the **SSH -> VCS**  section.  Click **Generate Key**.

<img src="/images/ansible_essentials/che_ssh_vcs.png" style="margin-left:2em;max-width:90%;">

Enter the private IP address (starts with `10.10.12.`) for the Gitlab server into the dialogue and click **OK**.

<img src="/images/ansible_essentials/che_ssh_vcs_hostname.png" style="margin-left:2em;max-width:90%;">

Select to view the newly generated public key and copy it to your clipboard.

<img src="/images/ansible_essentials/che_ssh_vcs_view.png" style="margin-left:2em;max-width:90%;">


**Gitlab Setup**

Switching gears a bit, now you need to login to Gitlab from the URL in your Access Guide and authenticate
using the student login credentials you've been assigned.

<img src="/images/ansible_essentials/gitlab_login.png" style="margin-left:2em;max-width:90%;">

After logging in click **Settings** available from the menu under your avatar in the top-right corner
of the screen

<img src="/images/ansible_essentials/gitlab_dashboard.png" style="margin-left:2em;max-width:90%;">

Click **SSH Keys** half-way down the lefthand sidebar.

<img src="/images/ansible_essentials/gitlab_settings.png" style="margin-left:2em;max-width:90%;">

Paste the key that you just generated within CHE and copied to your clipboard into the **Key** 
field, enter a **Title**, then press the **Add Key** button.

<img src="/images/ansible_essentials/gitlab_add_ssh_key.png" style="margin-left:2em;max-width:90%;">

When you public key has been saved to your Gitlab server the screen should look like this:

<img src="/images/ansible_essentials/gitlab_ssh_keys.png" style="margin-left:2em;max-width:90%;">

CHE should now be able to authenticate as your student account within Gitlab.

From Gitlab let's create a new project (their term for a git repository).  Navigate to the **Plus**
menu in the middle of the navbar then select **New project**.

<img src="/images/ansible_essentials/git_new_project.png" style="margin-left:2em;max-width:90%;">

Name your project **infrastructure-as-code-lab** and leave all other settings at their default values.

<img src="/images/ansible_essentials/git_new_project2.png" style="margin-left:2em;max-width:90%;">

Your new project (a.k.a git repo) is now empty - don't worry it won't be for long.  Click on the
blue **Clone** button then copy the **Clone with SSH** path to add the URL to your clipboard.

<img src="/images/ansible_essentials/git_clone_project.png" style="margin-left:2em;max-width:90%;">


###  Exercise 2.21 - Working with Git in CHE

Switch back to your CHE workspace, it's time to add your current (and future) Ansible playbooks into
git VCS.

The scaffolding you've been using for your exercises thus far was pulled from a public repo hosted
on Github.  During this exercise you will fork this repo and take ownership of it hosted within
your own Gitlab environment.  Isn't decentralized VCS awesome?

From your CHE workspace navigate to the **Git -> Remotes -> Remotes** menu.

<img src="/images/ansible_essentials/che_remotes.png" style="margin-left:2em;max-width:90%;">

Click the **Add** button to bring up the **Add Remote Repository** dialogue.  For the name
write `gitlab` and paste the URL you copied for Gitlab in the **Location** section.  Don't close the
dialogue just yet, since we need to change the URL a bit (an artifact of Gitlab running in a container 
is that the URL contains a funny hostname).

Change the hostname from the random looking string to the private IP address of the Gitlab server.
In the example below that is `20f8e44fd7d8` and replace it with the private IP address for Gitlab.

```
ssh://git@20f8e44fd7d8:8022/student0/infrastructure-as-code-lab.git   -- Old broken
ssh://git@10.10.12.82:8022/student0/infrastructure-as-code-lab.git    -- Fixed!
```

Then from **OK**.

<img src="/images/ansible_essentials/che_remotes.png" style="margin-left:2em;max-width:90%;">

Click the **Close** button to dismiss the **Remote repositories** dialogue.

<img src="/images/ansible_essentials/che_remotes_dialog2.png" style="margin-left:2em;max-width:90%;">

We're already ready to test this.  First, navigate back to the **Git -> Remotes -> Push** menu.

<img src="/images/ansible_essentials/che_remotes_push_menu.png" style="margin-left:2em;max-width:90%;">

Inside the **Push to remote repository** dialogue change the remote to `gitlab`.

<img src="/images/ansible_essentials/che_remotes_push_dialog.png" style="margin-left:2em;max-width:90%;">

CHE should now display a green toast notification that the push to Gitlab was successful.

<img src="/images/ansible_essentials/che_git_toast.png" style="margin-left:2em;max-width:90%;">


**Gitlab**

Change back to your Gitlab screen and refresh.  Your new project should now be populated with everything
you've been building.

<img src="/images/ansible_essentials/gitlab_repo_populated.png" style="margin-left:2em;max-width:90%;">

Moving foward you can make use of the git VCS within CHE (or on the command line if you prefer) to
safely store your code within Gitlab.


### 📗 Resources

 - [git cheat sheet](https://services.github.com/on-demand/downloads/github-git-cheat-sheet.pdf)
 - [git branches in a nutshell](https://git-scm.com/book/en/v2/Git-Branching-Branches-in-a-Nutshell)

