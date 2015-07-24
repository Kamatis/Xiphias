@echo off
echo Executing runner.sql...
mysql -u xiphias -pxiphias -Dxiphiasdb < sql/runner.sql
echo DONE
pause