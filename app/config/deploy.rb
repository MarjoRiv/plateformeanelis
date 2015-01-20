set :application, "Plateforme ANELIS"
set :domain,      "admin@92.222.76.35"
set :deploy_to,   "/usr/share/nginx/html/PLANELIS"
set :app_path,    "app"

set :repository,  "https://Dawlys@bitbucket.org/Dawlys/plateformeanelis.git"
set :ssh_options, { :forward_agent => true }
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :user, "admin"
set  :keep_releases,  3

default_run_options[:pty] = true
set  :use_sudo,      true

# Be more verbose by uncommenting the following line
# logger.level = Logger::MAX_LEVEL