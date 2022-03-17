zcat /home/cs143/data/googlebooks-eng-all-1gram-20120701-s.gz > TRIMMED_FILE
grep -v "_" TRIMMED_FILE > GREP_FILE
awk -F  '\t' '($2 >= 2000)' GREP_FILE > AWK_FILE
datamash --sort groupby 1 sum 3 < AWK_FILE > DATAMASH_FILE
sort -k 2,2rn DATAMASH_FILE | head -10
rm -f *FILE