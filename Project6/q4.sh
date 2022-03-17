zcat /home/cs143/data/googlebooks-eng-all-1gram-20120701-s.gz > TRIMMED_FILE
datamash groupby 1,2 sum 3 < TRIMMED_FILE | datamash --full --sort groupby 2 max 3 > DATAMASH_FILE 
awk -F  '\t' '($2 >= 1900)' DATAMASH_FILE | cut -f 1,2,3
rm -f *FILE