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
> touch file1 file2 file2
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
#    file2
#    file3
nothing added to commit but untracked files present (use "git add" to track)
```

We can stage these files for commit by using the `git add` command

```
> git add file1 file2 file3
```

See how the status output changes after staging those files.


**Committing changes**

The staged files are not yet immutably locked in the git VCS database, that can only be done
by commiting them.




**Creating branches**



**Merging changes**



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

