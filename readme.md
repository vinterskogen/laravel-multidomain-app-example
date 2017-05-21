# Laravel multidomain application example

<p align="center">
    <img src="https://cloud.githubusercontent.com/assets/8015372/26286018/eb47b438-3e63-11e7-9606-fd0277775a02.png?raw=true" alt="Network"/>
</p>

## Task

The core idea is to build system to run and manage a swarm of web-sites, that
have identical structure (e.g. use the same routes and pages templates), but
displays a different content to the visitors. Sites should have a site admin
panel to add and edit its content. Also, a master-admin panel show be present
in order to add and delete sites (assumed that sites list is stored in
database).

In common this is a typical **business case** for franchise or distributors sites
network.

So we need to make a multidomain application, that supports 3 different types
of web-interface and responds with one of them, according to which domain is
requested.

Types of web-interface:

1. **Sites**. A number of sites, that have identical structure and displays unique
content. Used by anonymous users (e.g. a typical sites' visitors). Each site is
located on its own domain. Examples: _franchise-partner.com_,
_distribution-partner.com_
2. **Site admin panel**. A dashboard to manage site content. Located on the same
domain with the site, with `/manager` prefix. Used by user with site-admin
role, assigned to manage one specified site. Examples:
_franchise-partner.com/manager_, _distribution-partner.com/manager_.
3. **Master-admin panel**. A dashboard to rule multiple sites (them all). Used by 
user(s) with the master-admin role. Located on a domain with a determined name.
Example: _master.acme.com_


## Dependencies

This example application requires Laravel 5.4.


## Architecture

Steps we need to take to implement described task using Laravel:

- In RouteServiceProvider:
    - Add a regexp pattern to match a domain. This pattern may be applied to a
group of routes within of its `domain` parameter in order to get the domain
that was requested. We add two named patterns:
        - `domain` - for matching any domain, will be used for sites
        - `masterAdminDomain` - for matching a domain of Master-admin panel
    - Define all the routes. Routes are stored in separate files inside a
`routes/web/` folder and wrapped in 3 groups (sorted by web-interface type),
with a number of attribute, such as `domain`, `namespace` and `prefix` for each
group.

- In AppServiceProvider:
    - Extend request facade by adding a `site` method, which returns the value
of the requested domain, extracting it from the Route parameters, where it was
stored while matching the `host` header from the income request against the
`domain` attribute (which includes previously defined named patterns) of the
groups of routes.

- Add a new middleware:
    - Add a `CheckDomainIsAllowed` middleware class to determinate is the
requested domain in list of allowed domains (otherwise abort request with HTTP
400 error response) and apply it to the route groups for sites and site admin
panels.

- Controllers changes:
    - Remove a `app/Http/Controllers/Controller.php` file
    - Add 3 folders (by web-interface type) into `app/Http/Controllers` folder
    - Add a base controller in each of 3 folders (`MasterAdmin`, `Admin`,
`Site`) and a HomeController


## Conclusion

Just run `phpunit`.

All the 3 cases are described and checked with feature (BDD) tests, palced in
`tests/Feature` folder. Feel free to explore them.

