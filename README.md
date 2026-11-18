# Sukabumi Tourism Website

A PHP and Apache tourism guide for Sukabumi, preserving the existing pages,
design, JavaScript interactions, and public JSON-backed visitor submissions.

## Local development

Requirements:

- PHP 8.2 or later
- Apache (the project can also be tested with PHP's built-in server)
- No database is required
- No API keys or environment secrets are required

Run locally with XAMPP or PHP:

```powershell
Set-Location C:\xampp\htdocs\Sukabumi_Tourism_Website
C:\xampp\php\php.exe -S 127.0.0.1:8090 -t .
```

Open `http://127.0.0.1:8090/`.

The existing visitor data files are:

- `data/letters.json`
- `data/complaints.json`

Do not delete these files. They are public-data files and must not contain
email addresses or private fields in the public records.

## Docker build

The project is intended to run behind Apache on the port supplied by Render.

```powershell
docker build -t sukabumi-tourism .
docker run --rm -p 10000:10000 -e PORT=10000 sukabumi-tourism
```

Open `http://localhost:10000/`.

The container includes PHP 8.3, Apache, `mbstring`, `intl`, `zip`, `mysqli`,
`pdo_mysql`, and OPcache. The app itself does not require a database.

## Render deployment

### 1. Create the service

1. Push this repository to GitHub.
2. In Render, select **New > Blueprint** and connect the repository.
3. Render reads `render.yaml` and creates the Docker web service.
4. Select or confirm the `free` service plan.
5. Do not attach a disk or add a paid database. The free plan is sufficient for
   the website and its temporary JSON submissions.

Letter and complaint submissions are stored temporarily in
`/tmp/sukabumi-data`. Records may disappear after a service restart,
redeployment, instance replacement, or other container lifecycle event.
This free configuration does not provide durable submission storage.

If you prefer to create the service manually:

- Runtime: **Docker**
- Dockerfile path: `./Dockerfile`
- Health check path: `/`
- Plan: **Free**
- Docker service port: Render sets it automatically

### 2. Environment variables

No secrets are required for the current application.

| Variable | Required value | Purpose |
| --- | --- | --- |
| `APP_ENV` | `production` | Selects production configuration |
| `SUBMISSION_DATA_DIR` | `/tmp/sukabumi-data` | Location of the temporary JSON files |

Render also supplies `PORT` at runtime.

Do not add secrets to `render.yaml`, Docker images, committed PHP files, or
GitHub. If credentials are added to a future integration, configure them only
as Render environment variables.

### 3. Temporary submission files

At startup, `docker/entrypoint.sh` creates `/tmp/sukabumi-data`, seeds
`letters.json` and `complaints.json` only if they do not exist, and gives the
Apache user ownership of the directory.

The files continue to use the existing structure:

- The public website reads and writes temporary `letters.json`
- The public website reads and writes temporary `complaints.json`
- Apache denies direct HTTP access to the `data` directory
- Submission emails are stored only as private form fields and are not rendered
  in the public cards
- Submissions are not permanently retained on the free plan

Before the first deployment, the existing JSON files should be committed. Each
new container instance seeds its temporary files once. Existing records in the
currently running container are not overwritten by the entrypoint.

## Security and production behaviour

- PHP errors are logged, not displayed
- Apache directory listing is disabled
- Dot files, environment files, configuration files, and the data directory
  are not publicly accessible
- Forms preserve the existing CSRF session token and honeypot checks
- Session cookies are HTTP-only and use SameSite=Lax
- Render HTTPS deployments use a Secure session cookie
- Security headers are configured by Apache

## Verification

Before deployment:

```powershell
Get-ChildItem -Recurse -Filter *.php |
  ForEach-Object { C:\xampp\php\php.exe -l $_.FullName }
```

After deployment, test:

1. `/` loads the homepage.
2. `/destination.php`, `/city.php`, and `/culinary.php` load.
3. `/letters.php` submits and shows a letter.
4. `/complaint.php` submits and shows a complaint.
5. Each submitted record remains available while the current container instance
   is running. It may be lost after a redeploy or restart.