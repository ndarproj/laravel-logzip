module.exports = {
	apps: [
		{
			name: 'log-zip',
			interpreter: 'php',
			script: 'artisan',
			args: 'log:zip',
			watch: false,
			cron: '0 * * * *',
			autorestart: false,
		}
	]
};