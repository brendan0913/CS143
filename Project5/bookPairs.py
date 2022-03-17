from pyspark import SparkContext
from itertools import combinations
sc = SparkContext("local", "books")

lines = sc.textFile("/home/cs143/data/goodreads.user.books")
lines = lines.map(lambda line: line[line.find(':')+1:])
lines = lines.map(lambda line: line.split(","))
lines = lines.filter(lambda line: len(line) >= 2)
lines = lines.map(lambda line: [int(c) for c in line])
lines = lines.map(lambda line: list(combinations(line, 2)))
lines = lines.flatMap(lambda line: [c for c in line])
lines = lines.map(lambda c: (c, 1))
lines = lines.reduceByKey(lambda a, b: a+b)
lines = lines.filter(lambda pair: pair[1] > 20)
lines.saveAsTextFile("./output")
