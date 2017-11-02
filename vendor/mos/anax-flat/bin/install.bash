#
# Install Anax Flat for a dbwebb article composer.
# Execute though:
# bash -c "$(cat install.bash)"
# bash -c "$(wget -qO- https://raw.githubusercontent.com/mosbth/dbwebb-cli/master/install.bash)"
#
#TMP="/tmp/$$"
#TARGET="https://raw.githubusercontent.com/mosbth/dbwebb-cli/master/dbwebb2"
#PATH1="/usr/local/bin"
#PATH2="/usr/bin"
#WHERE="$PATH1/dbwebb"

ECHO="echo -e"
ECHON="echo -n"
MSG_DOING="\033[1;37;40m[anax install]\033[0m"
#MSG_DONE="\033[1;37;40mDone\033[0m"
MSG_DONE="Done"
#MSG_WARNING="\033[43mWARNING\033[0m"
MSG_FAILED="\033[0;37;41mFAILED\033[0m"


#
# Check if all tools are available
#
function checkTool() {
    $ECHON "$1 "
    if ! hash php 2> /dev/null; then
        $ECHO "$MSG_FAILED Missing $1, install it: $2"
        exit -1
    fi
}

$ECHO "$MSG_DOING Checking for tools..."

checkTool "php"      "https://dbwebb.se/labbmiljo/php-i-pathen"
checkTool "composer" "https://dbwebb.se/labbmiljo/composer"
checkTool "make"     "https://dbwebb.se/labbmiljo/make"

$ECHO "\n$MSG_DONE checking tools."



#
# Install using composer
#
$ECHO "$MSG_DOING Installing Anax Flat..."

if [ "$(ls -A $PWD)" ]; then
    $ECHO "$MSG_FAILED This directory is not empty, exiting. Only installing into an empty directory."
    exit -1
fi

composer require mos/anax-flat
cp vendor/mos/anax-flat/Makefile .
make site-build-dbwebb

$ECHO "$MSG_DONE installing Anax Flat."

# if hash wget 2> /dev/null; then
#     echo "Using wget."
#     wget -qO $TMP $TARGET 
# elif hash curl 2> /dev/null; then
#     echo "Using curl."
#     curl -so $TMP $TARGET
# else
#     echo "Failed. Did not find wget nor curl. Please install either wget or curl."
#     exit 1    
# fi
# 
# if [ ! -d "$PATH1" ]; then
#     WHERE="$PATH2/dbwebb"
# fi
# 
# echo "[dbwebb] Installing into '$WHERE'."
# install -v -m 0755 $TMP $WHERE
# 
# if [[ $? != 0 ]]; then
#     echo "[dbwebb] FAILED. Could not successfully execute the install command."
#     echo "Try re-run the installation-command as root using 'sudo'."
#     echo "Or, execute the following command, as root or using sudo, to move 'dbwebb' into its place in $WHERE."
#     echo " install -v -m 0755 $TMP $WHERE"
#     echo "Or, install using the manual procedure, as explained here:"
#     echo " http://dbwebb.se/dbwebb-cli#steg"
#     exit 1
# fi
# 
# ls -l $WHERE
# 



#$ECHO "$MSG_DOING Cleaning up."
#rm $TMP

#echo "[dbwebb] Check what version we have."
#dbwebb --version

$ECHO "$MSG_DONE installing, seems to be succesfull."
$ECHO "$MSG_DOING Get to work."
$ECHO "Open your web browser to the htdocs directory to see the website."
$ECHO "Execute 'make' to see what can be done."
