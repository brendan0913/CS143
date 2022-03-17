zcat /home/cs143/data/googlebooks-eng-all-1gram-20120701-s.gz > TRIMMED_FILE
datamash groupby 1 sum 3 < TRIMMED_FILE > DATAMASH_FILE
awk -F  '\t' '($2 >= 1000000)' DATAMASH_FILE
rm -f *FILE