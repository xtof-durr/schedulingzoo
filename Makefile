all:: verify install

verify:
	mkdir -p dot
	rm -f dot/*
	python3 ./extract.py form       > form.php
	python3 ./extract.py reductions > reductions.py
	python3 ./extract.py references > references.py
	python3 ./extract.py results    > results.py
	python3 ./extract.py stat       > stat.html
	python3 ./extract.py dot        > dot.html
	bash ./dot2png.sh

install:
	rsync -rv --delete . ssh.lip6.fr:WWW/query/
