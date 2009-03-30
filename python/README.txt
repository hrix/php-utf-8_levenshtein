■PythonのDocTestを付けてみた

◇テストコードの実行
D:\www\github\php-utf-8_levenshtein>C:\Python26\python python/levenshtein.py a b -v

◇Python コマンドラインからの実行
>>> 
os.chdir('d:')
os.chdir('/www/github/php-utf-8_levenshtein/python/')
import levenshtein
levenshtein.levenshtein_distance('a','b')

