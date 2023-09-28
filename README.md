## README
### This is a deploying instruction.
- At first you need to specify all env variables by using: `"make env"` command - it will copy all ENV variables. from `.env.example` to `.env` file.
- Then you have to specify all ENV variables in `.env` file.
- Run `"make setup"` command to create docker container, change chmod of the wordpress directory, install all composer dependencies and wordpress plugins. Or you can run all this commands separately and skip some of them. Correct sequence: `"make docker-up"` -> `"make chmod-wp"` -> `"make composer"`. 
- Now you can open `"http://localhost"` and install WordPress, all necessary plugins will already be installed

### This is an instruction how to make branches and commits.
###### Branch template:
- `<prefix>/<task number>-<short name>`. Prefix may be one of:
  - feature
  - fix
  - hotfix
  - refactoring
  - tools
- Example: `feature/XPRT-15-edit-general`
###### Commit template:
- `<scope>:<task number> <subject>`:
  - The `<scope>` could be anything specifying the place of the commit change. For example core, tools, common, insights, marketplace, admin, signup, campaign, creator, export, etc.
  - The `<subject>` contains succinct description of the change: 
    1. use the imperative, present tense: "change" not "changed" nor "changes"
    2. don't capitalize first letter
    3. no dot (.) at the end
- Example: `common: XPRT-123 add edit project page`