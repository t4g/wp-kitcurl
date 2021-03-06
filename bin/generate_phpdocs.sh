#!/bin/bash

_INSTALLPATH=$(dirname `dirname $0`);

cd "${_INSTALLPATH}";

echo "CURRENT DIR `pwd`"
echo "INSTALL DIR ${_INSTALLPATH}"

_MYLUCKYPATHIS=`pwd`

_PHPDOC="bin/phpdoc.php"


[[ ! -f $_PHPDOC ]] && [[ -f `which phpdoc` ]] && _PHPDOC=`which phpdoc` || echo "no phpdoc library found"

echo "Using this $_PHPDOC";

$_PHPDOC \
--directory="`pwd`" \
--progressbar  \
--ignore=vendor/_develop/*,developer/vendor/*,docs/library* --sourcecode \
--target=docs/library --title=wp-kitcurl --template=clean;



