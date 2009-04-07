■PythonのDocTestを付けてみた

◇テストコードの実行
D:\www\github\php-utf-8_levenshtein>C:\Python25\python python/levenshtein.py a b -v
※Docプロンプトで確認しているため文字コードがcp932に。

◇Python コマンドラインからの実行
>>> 
os.chdir('d:')
os.chdir('/xampp/hirai/github/php-utf-8_levenshtein/python/')
import levenshtein
levenshtein.levenshtein_distance('a','b')
levenshtein.levenshtein_distance('Gショック','爺ショップ')

