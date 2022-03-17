zcat /home/cs143/data/googlebooks-eng-all-1gram-20120701-s.gz > TRIMMED_FILE
awk -F  '\t' '($3 >= 1000*$4)' TRIMMED_FILE > AWK_FILE
cut -f 1,2 AWK_FILE
rm -f *FILE