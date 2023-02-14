all:
	./extract.py form       > form.php
	./extract.py reductions > reductions.py
	./extract.py references > references.py
	./extract.py results    > results.py
	./extract.py stat       > stat.txt
	./extract.py dot        > dot.html
	./dot2png.sh

install:
	rsync -rv --delete . lip6:WWW/query/
