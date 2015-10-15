sudo /usr/local/mysql/support-files/mysql.server start
cd /usr/local/mysql/bin
echo "Executing runner.sql"
./mysql -u xiphias -p xiphiasdb < /Library/WebServer/Documents/Xiphias/sql/sql/runner.sql
echo "DONE"
