tail -n 40 file1 > file2 ; head -n 10 file2 > file3 ; grep koko file2 > file4 && sed -i 's/koko/kyky/g' file4 ; head -n 3 file4 » file3 ; sort file3 | uniq -c && sort -u file3 -o file3
![image](https://user-images.githubusercontent.com/91589476/157446585-3f1da58f-5e28-4701-a73c-177db899aed4.png)

