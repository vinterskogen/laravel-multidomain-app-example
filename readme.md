# Laravel multidomain application example

## Task

The core idea is to build system to run and manage a swarm of web-sites, with
identical structure (that use the same routes and templates), but have a
different content with a site admin panel to edit content on site, and a master
admin panel to add and delete sites.

This is a typical business case for franchise or distributors network.

So we need to make a multidomain application, that supports 3 different types of
web-interface and responds according to which domain is requested, with whole
different routes tables for each type.

Types of web-interface:

1. **Master admin panel**. A place for master-admin to rule multiple sites (them all).
Located on a domain with a determined name. Example: master.foobar.com
2. **Sites**. A number of sites, that provide identical pages with different
content for the internet users. Each site is located on its own domain. Sites
(including their `domain` attribute) are added and removed at master admin panel.
3. **Site admin panel**. A place to manage site content. Located on the same domain
with the site, with `/manager` prefix.

## Arcitecture

- In RouteServiceProvider:
    - Add a regexp pattern to match a domain. This pattern may be applied to a
group of routes inside of its `domain` parameter to get the domain that was
requested. We add two named patterns:
        - 'domain' - for matching any domain. Will be used for Sites.
        - 'masterAdminDomain' - for matching a domain of Master admin panel.
    - Define all the routes. Routes are stored in separate files inside a
`routes/web/` folder and wrapped in 3 groups (by web-interface type), with
a number of attribute, such as `domain`, `namespace` and `prefix` for each
group.

- In AppServiceProvider:
    - Extend request facade by adding a `site` method, which returns the value
of the requested domain, extracting it from the Route parameters, where it was
stored while matching the `host` header from the users' request against the
`domain` attribute (which includes previously defined named patterns) of the
groups of routes.

- Add a new middleware:
    - Add a `CheckDomainIsAllowed` middleware class to determinate is the
requested domain in list of allowed domains (if not - response with 400 error)
and apply it to the route groups for sites and site admin panels.

- Controllers changes:
    - Remove a `app/Http/Controllers/Controller.php` file
    - Add 3 folders (by web-interface type) into `app/Http/Controllers` folder
    - Add a base controller in each of 3 folders (`MasterAdmin`, `Admin`, `Site`)
and a HomeController

## Dependencies

This example application requires Laravel 5.4.

## Conclusion

All the 3 cases are described with feature (BDD) tests within the `tests/Feature`.
Just run `phpunit`.
