<a id="top"></a>

<p align="center">
  <img src=".github/assets/readme/banner.svg" alt="Smart School: one platform to run every branch of your school" width="100%">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.3+">
  <img src="https://img.shields.io/badge/Laravel-10-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 10">
  <img src="https://img.shields.io/badge/MySQL%20%2F%20MariaDB-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL or MariaDB">
  <img src="https://img.shields.io/badge/Apache-D22128?style=for-the-badge&logo=apache&logoColor=white" alt="Apache">
</p>

<p align="center">
  A multi-branch school management system with a public website for each branch.<br>
  Migrated from CodeIgniter (HMVC) to Laravel 10, and being rewritten as native Laravel module by module.
</p>

<p align="center">
  <a href="#modules"><b>Modules</b></a> &nbsp;·&nbsp;
  <a href="#requirements"><b>Requirements</b></a> &nbsp;·&nbsp;
  <a href="#installation"><b>Installation</b></a> &nbsp;·&nbsp;
  <a href="#architecture"><b>Architecture</b></a> &nbsp;·&nbsp;
  <a href="#development"><b>Development</b></a> &nbsp;·&nbsp;
  <a href="#tests"><b>Tests</b></a>
</p>

<p align="center">
  <img src=".github/assets/readme/stats.svg" alt="28 module groups, 100 database tables, 6 payment gateways, 13 SMS gateways" width="100%">
</p>

<a id="modules"></a>

## <img src=".github/assets/readme/icons/academics.svg" width="30" align="top" alt=""> Modules

<table>
  <tr>
    <td width="33%" align="center" valign="top">
      <img src=".github/assets/readme/icons/academics.svg" width="56" alt=""><br>
      <b>Academics</b><br>
      <sub>Classes, sections, subjects, syllabus, materials, routines, live classes, promotion, assignments</sub>
    </td>
    <td width="33%" align="center" valign="top">
      <img src=".github/assets/readme/icons/people.svg" width="56" alt=""><br>
      <b>People</b><br>
      <sub>Students, admissions, guardians, teachers, employees, designations</sub>
    </td>
    <td width="33%" align="center" valign="top">
      <img src=".github/assets/readme/icons/attendance.svg" width="56" alt=""><br>
      <b>Attendance and leave</b><br>
      <sub>Student, teacher and employee attendance, absence notices, leave applications</sub>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top">
      <img src=".github/assets/readme/icons/exams.svg" width="56" alt=""><br>
      <b>Exams</b><br>
      <sub>Schedules, marks, results, mark sheets, merit lists, result cards, grades, suggestions</sub>
    </td>
    <td align="center" valign="top">
      <img src=".github/assets/readme/icons/finance.svg" width="56" alt=""><br>
      <b>Finance</b><br>
      <sub>Invoices, fee types, discounts, payments, receipts, income, expenditure, payroll, reports</sub>
    </td>
    <td align="center" valign="top">
      <img src=".github/assets/readme/icons/facilities.svg" width="56" alt=""><br>
      <b>Facilities</b><br>
      <sub>Library, hostel, transport</sub>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top">
      <img src=".github/assets/readme/icons/communication.svg" width="56" alt=""><br>
      <b>Communication</b><br>
      <sub>Messages, email, SMS, notices, news, holidays, events, complaints</sub>
    </td>
    <td align="center" valign="top">
      <img src=".github/assets/readme/icons/documents.svg" width="56" alt=""><br>
      <b>Documents</b><br>
      <sub>ID cards, admit cards, certificates</sub>
    </td>
    <td align="center" valign="top">
      <img src=".github/assets/readme/icons/frontoffice.svg" width="56" alt=""><br>
      <b>Front office</b><br>
      <sub>Visitors, call logs, postal dispatch and receive</sub>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top">
      <img src=".github/assets/readme/icons/administration.svg" width="56" alt=""><br>
      <b>Administration</b><br>
      <sub>Schools and branches, roles and permissions, users, languages, themes, settings, backup, activity log</sub>
    </td>
    <td align="center" valign="top">
      <img src=".github/assets/readme/icons/website.svg" width="56" alt=""><br>
      <b>Public website</b><br>
      <sub>Per-branch pages, online admission, gallery, contact form</sub>
    </td>
    <td align="center" valign="top">
      <img src=".github/assets/readme/icons/integrations.svg" width="56" alt=""><br>
      <b>Integrations</b><br>
      <sub>Payment and SMS gateways, listed below</sub>
    </td>
  </tr>
</table>

**Payment gateways**

<kbd>DBBL</kbd> <kbd>PayPal</kbd> <kbd>PayUMoney</kbd> <kbd>CCAvenue</kbd> <kbd>Paytm</kbd> <kbd>Paystack</kbd>

**SMS gateways**

<kbd>Clickatell</kbd> <kbd>Twilio</kbd> <kbd>Bulk</kbd> <kbd>MSG91</kbd> <kbd>Plivo</kbd> <kbd>Textlocal</kbd> <kbd>SMSCountry</kbd> <kbd>BetaSMS</kbd> <kbd>BulkPK</kbd> <kbd>Cluster</kbd> <kbd>Alpha</kbd> <kbd>BDBulk</kbd> <kbd>MiMSMS</kbd>

<a id="requirements"></a>

## <img src=".github/assets/readme/icons/requirements.svg" width="30" align="top" alt=""> Requirements

- **PHP** 8.3 or newer
- **Composer**
- **MySQL** or **MariaDB**
- **Apache** with `mod_rewrite` (for example WAMP), or `php artisan serve`

> [!NOTE]
> Node is not needed to run the application. No view uses Vite: the CSS and JavaScript are served directly from `public/assets`.

<a id="installation"></a>

## <img src=".github/assets/readme/icons/installation.svg" width="30" align="top" alt=""> Installation

<kbd>STEP 1</kbd> **Install the dependencies and create the environment file**

```bash
composer install
cp .env.example .env
php artisan key:generate
```

<kbd>STEP 2</kbd> **Configure the database**

Set the `DB_*` values in `.env`. The example file uses port `3307` and the database `smartinternation_school`.

<kbd>STEP 3</kbd> **Create the database and restore the data**

The dump is not in this repository, so get `smartinternation_school.sql` from a project maintainer and put it in the project root. To start without real data, create an empty database and skip the second command.

```bash
mysql -h 127.0.0.1 -P 3307 -u root -e "CREATE DATABASE smartinternation_school"
mysql -h 127.0.0.1 -P 3307 -u root smartinternation_school -e "source smartinternation_school.sql"
```

<kbd>STEP 4</kbd> **Run the migrations and the seeders**

```bash
php artisan migrate
php artisan db:seed
```

The seeders print the `superadmin` password once, so note it down.

<kbd>STEP 5</kbd> **Open the application**

| Server | URL |
| --- | --- |
| WAMP | `http://localhost/ssm/public/` |
| `php artisan serve` | `http://localhost:8000` |

The login page is at `/login`.

### Database notes

- **With a dump:** the migration sees the existing tables and leaves them alone. Rolling it back does not drop them. `php artisan db:seed` only fills the Spatie tables from the dump's `privileges`, `roles` and `users` rows.
- **Without a dump:** `php artisan migrate` creates all the tables from `database/schema/application.sql`, but that file contains no data. `php artisan db:seed` then creates the settings, one branch, an academic year, the roles and permissions, and a `superadmin` account. Classes, students and other school records stay empty.
- **Seeding again** is safe. `ApplicationSeeder` does nothing if users or settings exist, and a Spatie role that already has permissions keeps them.

<a id="architecture"></a>

## <img src=".github/assets/readme/icons/architecture.svg" width="30" align="top" alt=""> Architecture

The application is being rewritten as native Laravel one module at a time. Rewritten code and legacy code run side by side and share the session, so each module can move on its own.

| Status | Modules |
| --- | --- |
| Native Laravel | Login, logout and password reset; roles and permissions |
| Legacy | Everything else, including the rest of Administrator and the shared layout |

Authorization is already on [spatie/laravel-permission](https://spatie.be/docs/laravel-permission) for every module, because the legacy `has_permission()` and `check_permission()` helpers call it.

Legacy controllers, models and views still run almost unchanged, on top of a compatibility layer in `app/Legacy`.

<p align="center">
  <img src=".github/assets/readme/request-flow.svg" alt="Request flow: request, StripUrlSuffix, routes/legacy.php, LegacyDispatcher, App\Legacy\Runtime, controller action, Laravel response" width="100%">
</p>

| Path | Contents |
| --- | --- |
| `routes/web.php` | Routes of the rewritten modules. Loads before `routes/legacy.php` |
| `routes/legacy.php` | Routes of the legacy modules |
| `app/Legacy` | The CodeIgniter compatibility layer: base controller and model, loader, query builder, session, input, helpers |
| `app/Legacy/LayoutHost.php` | Renders a Blade page inside the legacy layout |
| `app/Http/Controllers/<Module>` | Controllers, grouped by module. Rewritten ones are named `*Controller` |
| `app/Models/<Module>` | Legacy models, grouped by module. Eloquent models are in `app/Models` |
| `app/Services`, `app/Http/Requests` | Services and form requests of the rewritten modules |
| `resources/views/<module>` | Views, grouped by module: Blade (`.blade.php`) when rewritten, otherwise plain PHP |
| `app/Libraries` | Libraries loaded with `$this->load->library()` |
| `lang/english` | Language files, read by `lang()` and by `__()` in Blade |
| `database/seeders/data/permissions.php` | The default modules, operations and role access for a new database |
| `public/assets` | CSS, JavaScript, images and uploaded files |
| `database/schema/application.sql` | The application's table definitions |

The `application` directory, if you have one locally, is the old CodeIgniter code. It is ignored by Git and is not used at runtime.

<a id="development"></a>

## <img src=".github/assets/readme/icons/development.svg" width="30" align="top" alt=""> Development notes

### Roles and permissions

Permissions are named `module.operation.action`, where the action is `view`, `add`, `edit` or `delete`:

```php
Route::get('roles', [RoleController::class, 'index'])->middleware('permission:administrator.role.view');
```

```blade
@can('academic.classes.edit') ... @endcan
```

A Spatie role in `permission_roles` has the same `id` as its row in the application's `roles` table, because the legacy modules read `users.role_id`. Change roles through `RoleController`, which keeps the two tables in step. Legacy modules create users without touching the Spatie tables, so the login assigns a missing role.

The `privileges` table is only read by `RolePermissionSeeder`. Saving the permission page changes the Spatie tables and nothing else.

### Rewriting a legacy module

1. Add routes to `routes/web.php` with the `permission:` middleware, and a redirect from each old URL that people may have saved. Remove its `Route::ci()` line.
2. Write a `*Controller` with Eloquent or the query builder, and a form request for validation.
3. Convert the views to Blade, with `@csrf` in every form and `__('key')` for text. Until the layout is rewritten, return the page through `LayoutHost::respond()`.
4. Add feature tests, then delete the old controller, model and views.

### Adding a legacy controller action

Routes are not discovered automatically. Add the method name to the controller's `Route::ci()` line in `routes/legacy.php`, or the URL returns a 404:

```php
Route::ci('academic/classes', \App\Http\Controllers\Academic\Classes::class, ['index', 'add', 'edit', 'name', 'delete'], 'academic', 'classes');
```

Extra URL segments are passed to the action as arguments, so `/academic/classes/edit/5` calls `edit('5')`.

### Route order matters

Custom routes come first, and `(:any)` matches any single-segment URL as a school's website.

| URL | Opens |
| --- | --- |
| `/dashboard` | The public website controller |
| `/dashboard/index` | The dashboard |

### Legacy behaviour to keep in mind

> [!CAUTION]
> - Routes in the `legacy` middleware group have no CSRF protection, because the old forms and AJAX calls do not send a token.
> - Some legacy pages still store `users.temp_password`, a Base64 copy of the password that anyone with database access can read, and `administrator/usercredential` displays it.

- New passwords are hashed with bcrypt. Older rows may hold MD5 hashes, and `User::checkPassword()` replaces one with bcrypt at the next successful login.

- Notices and warnings are hidden during a legacy request, so an undefined index will not raise an error.
- Relative paths such as `./assets/uploads/` resolve against `public`, because `Runtime` changes the working directory there.

<a id="tests"></a>

## <img src=".github/assets/readme/icons/tests.svg" width="30" align="top" alt=""> Tests

```bash
php artisan test
```

The tests run on an in-memory sqlite database set in `phpunit.xml`, and `Tests\TestCase` refuses any other connection, so they cannot touch the database in `.env`. `database/schema/application.sql` is written for MySQL, so `tests/CreatesApplicationSchema.php` creates the tables the tested pages use. Add a table there when a new test needs one.

Most legacy modules have no tests yet, and the tests do not catch MySQL-specific problems, so check those in a browser as well.

---

<p align="center"><a href="#top"><b>Back to top</b></a></p>
