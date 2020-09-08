Assume we have a table in CSV format that contains info about people with following fields:

ID - primary key

PARENT_ID - parent of the sequence, initially is not set  
EMAIL  
CARD  
PHONE  

The table can contain more data (name, date of birth etc.), we can just ignore them. The fields that we are interested in are always present and are not empty.

Data in the table can have duplicates. Records can be considered duplicates if values of at least one of the fields (EMAIL, CARD, PHONE) are the same.

The task is to form a chain of duplicates with PARENT_ID equal to the lowest ID from the chain.

Example of input data:

ID,PARENT_ID,EMAIL,CARD,PHONE,TMP  
1,NULL,email1,card1,phone1,  
2,NULL,email1,card2,phone2,  
3,NULL,email3,card3,phone3,  
4,NULL,email4,card4,phone2,  


Example of output data:

ID,PARENT_ID  
1,1  
2,1  
3,3  
4,1  

1,2,4 has PARENT_ID=1 (it's the lowest ID in chain: 1 and 2 has common EMAIL, 2 and 4 - common PHONE) and in third row PARENT_ID=3 (has no duplicates).
