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
	rclone sync --sftp-host=schedulingzoo.proj.lip6.fr --sftp-user=schedulingzoo . :sftp:web/site/
