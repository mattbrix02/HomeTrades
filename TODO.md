# TODO

- [ ] Update `app/Policies/ProjectPolicy.php` to allow admin-only create/update/delete and related abilities.
- [ ] Update `app/Http/Requests/StoreProjectRequest.php` authorize() to admin-only.
- [ ] Update `app/Http/Requests/UpdateProjectRequest.php` authorize() to admin-only.
- [ ] Implement admin-only CRUD in `app/Http/Controllers/ProjectController.php`.
- [ ] Ensure `destroy` archives projects via SoftDeletes.
- [ ] Implement Inertia page(s) needed for Project create/edit (if missing):
  - [ ] `resources/js/Pages/Project/Create.vue`
  - [ ] `resources/js/Pages/Project/Edit.vue`
  - [ ] `resources/js/Pages/Project/Index.vue` / list usage alignment
- [ ] Add/adjust any frontend links to use `projects.*` routes instead of `courses.*` (if required).
- [ ] Run basic checks: `php artisan route:list` and a quick lint/test if available.

