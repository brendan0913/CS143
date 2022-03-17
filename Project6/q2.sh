zcat /home/cs143/data/googlebooks-eng-all-1gram-20120701-s.gz > TRIMMED_FILE
awk -F  '\t' '($4 >= 10000)' TRIMMED_FILE > AWK_FILE
sort -k 2,2n AWK_FILE | head -1 > SORT_FILE
cut -f 2 SORT_FILE
rm -f *FILE