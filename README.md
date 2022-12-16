date('Y-m-d H:i:s', strtotime('+9hour'));

----------------------------------------------

cd /var/www/

sudo su

rm -rf html

mkdir html

cd html

git clone https://github.com/TsugawaNaoki0/bulletin.git

mv bulletin/* ./

chmod 666 test.txt

while true; do python3 reader.py; sleep 10s; done
