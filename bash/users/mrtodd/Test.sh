#@author : Mark Todd
#
#Description : Retrieve information on files altered within a timeframe
#
#@params : 	1. starting directory for file search
#	 :	2. timeframe (uses mtime, as in floor
#			(timedifference/86400);)
#	 :	3. evaluation mode;
#			'1' for summary mode
#			'2' for verbose mode

die () {
	echo >&2 "Error: $@"
	exit 1
}

argC=3
[ "$#" -eq $argC ] || die "Expected format: $0 <directory> <timeframe> {1,2}"

# using + here causes a much more efficient call (ideally) by calling
# ls with the full list instead of executing separately.

fileStr=$(find "$1" -type f -mtime "$2" -exec ls -l '{}' + | sort -k 3,3)

if [ -z "$fileStr" ]
then
	echo "No files changed during that timeframe."
	exit
fi

if [ "$3" -eq 1 ] 
then
	echo "$fileStr" | awk '
		{countDic[$3]++} 
		END {
			print "Owner\tNumber of files changed"; 
			for(i in countDic) {
				print i, "\t", countDic[i]}
		}'
else
	echo "$fileStr" | awk ' 
	{ if( curuser !=$3 )
		{ curuser=$3 ; print "\n" $3} ;
	print }'
fi
