./propel sql:build --overwrite
if [ "$?" != 0 ]; then
	echo "sql:build failed, exit"
	exit 1
fi

./propel model:build
if [ "$?" != 0 ]; then
	echo "model:build failed, exit"
	exit 2 
fi
./propel config:convert
if [ "$?" != 0 ]; then
	echo "config:convert failed, exit"
	exit 3
fi

php composer.phar update
if [ "$?" != 0 ]; then
	echo "composer update failed, exit"
	exit 4 
fi
