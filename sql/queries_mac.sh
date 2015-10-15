sudo /usr/local/mysql/support-files/mysql.server start
cd /usr/local/mysql/bin
./mysql -u xiphias -p xiphiasdb < /Library/WebServer/Documents/Xiphias/sql/sql/queries.sql
echo "DONE"

