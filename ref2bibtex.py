#!/usr/bin/env python3

import sys
from bibtexparser.bwriter import BibTexWriter
from bibtexparser.bibdatabase import BibDatabase
from references import references
import extract

print("<pre>")
if len(sys.argv) != 2:
    print("invalid arguments")
    sys.exit(0)
else:
    id = sys.argv[1]

    if id not in references:
        print("unkown bibtex id '%s'" % id)
        sys.exit(0)
    else:
        writer = BibTexWriter()
        db = BibDatabase()
        db.entries = [references[id]]
        print(writer.write(db))
print("</pre><p>")

