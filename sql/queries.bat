@echo off
echo Executing queries.sql...
mysql -u xiphias -pxiphias -Dxiphiasdb < sql/queries.sql
echo DONE
pause