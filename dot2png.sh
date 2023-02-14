for f in dot/*.dot 
do
   dot "$f" -T png > "$f.png" 
done

