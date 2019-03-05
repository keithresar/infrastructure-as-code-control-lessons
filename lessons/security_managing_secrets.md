# Managing Secrets

Before we can fix the ACLs blocking access to our web and API servers we need to get the keys
to read and make changes to our AWS VPC.

We've already worked with three secrets, both managed in a pretty insecure manner:

* In your inventory we've hardcoded user passwords
* The private ssh key used to login to your servers is checked into a public Github repo and 
  visible in the `files/` subdirectory of your lesson repo
* The LanguageLayer API key is just sitting in a text file in the `/tmp/` directory on your
  server.

Now let's start working with a secret vault.

Ansible includes something called an `ansible-vault` which can encrypt any file Ansible works with.
including:

* Variables
* Playbooks
* Templates and Files

Ansible Tower includes similar functionality that's focussed more on secrets used for variables.

While these Ansible provided vaults are cryptographically secure, they don't take into account many of the
requirements for an Enterprise secret store.  Consider just a few:

* Secret check-in/check-out
* Secret rotation
* Automatically disabling secrets after expiration or after use
* Creating new secrets on demand so no application can replay

There are many vendors offering Enterprise secret vault functionality, most common is CyberArk and HashiCorp Vault.
Today we will interact with the latter.

<hr>

### Exercise 4.3 Interacting with Vault CLI

HashiCorp Vault includes a CLI with which you can manage secrets.  
Explore the quick lesson on setting and retrieving secrets using the CLI linked below:

https://learn.hashicorp.com/vault/getting-started/first-secret

Please make sure to select names for your secrets that are tagged with your student number to prent inadvertently
overwriting another student's data.

For this to work you need to set two environment variables: 

```
> export VAULT_ADDR=http://127.0.0.1:8200 VAULT_TOKEN='R3dh@t12'
```


### Exercise 4.4 Retrieve Secret for Ansible Vault

Keys for the AWS VPC running the lab's instances are stored in a HashiCorp Vault.  
Using the `hashi_vault` lookup plugin extract the keys that reside under `aws_keys`.


** Hints **

*Hints are hidden behind **spoiler** tags.  You can view the text associated with these hints by highlighting the space to the right of the *spoiler* placeholder text.*

! tbd



### 📗 Resources

 - [HashiCorp Vault Quick Start](https://learn.hashicorp.com/vault/getting-started/first-secret)
 - [hashi_vault plugin](https://docs.ansible.com/ansible/latest/plugins/lookup/hashi_vault.html)

