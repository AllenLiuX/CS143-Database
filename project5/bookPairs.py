from pyspark import SparkContext
sc = SparkContext("local", "bookPairs")

def get_books(line):
    user, books = line.split(":")
    books_li = books.split(",")
    return books_li
    books_res = []
    for book in books_li:
        book_int = int(book)
        books_res.append(book_int)
    return books_res

def pairing(s):
    res = []
    for i in range(len(s)-1):
        for j in range(i+1, len(s)):
            res.append((s[i], s[j]))
    return res

def gt20(line):
    pair, count = line
    return int(count) > 20

lines = sc.textFile("/home/cs143/data/goodreads.user.books")
books = lines.map(get_books)
pairs = books.flatMap(pairing)
pairs_1 = pairs.map(lambda x: (x, 1))
pair_count = pairs_1.reduceByKey(lambda a, b: a+b)
book_count_gt20 = pair_count.filter(gt20)
book_count_gt20.saveAsTextFile("./output")