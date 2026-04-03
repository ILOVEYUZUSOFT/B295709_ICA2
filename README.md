## B295709_ICA2
**Introduction to Website and Database Design (BILG11016)**  
**Student ID:** B295709  
**Website:** https://bioinfmsc8.bio.ed.ac.uk/~s2827275/Website/

--
## Overview
This project is a bioinformatics analysis platform that allows users to dynamically retrieve protein sequences with user-defined protein family and taxonomic group from NCBI. 
Website also provides a serious of bioinformatics analysis to evaluate the conservation of query results.

--
## Features
The website includes the following six core features:

- **1.** Retrieve specified proteins from NCBI based on user-defined requirements  
- **2.** Perform protein conservation analysis on the search results and provide conservation plots  
- **3.** Scan sequences using PROSITE motifs  
- **4.** Perform EMBOSS pepstats analysis on sequences and provide amino acid composition plots  
- **5.** Provide example datasets to demonstrate the website's functionality to users  
- **6.** Upon completing a search, users receive a unique Access Code that can be used to revisit their historical analysis data  

--
## Tech Stack
- **Frontend:** HTML5, CSS3, Bootstrap 5, JavaScript  
- **Backend:** PHP, MySQL  
- **Sequence Retrieval:** Python + Bio.Entrez  
- **Bioinformatics Tools:** EMBOSS (patmatmotifs, pepstats), Clustal Omega, Biopython

--
## About Ignored Files
`db.php` and `scripts/fetch_sequences.py` have been added to `.gitignore` because they contain sensitive information (database username/password and NCBI API Key/personal email).  

They are not uploaded to GitHub.

--
## Acknowledgements
- Course Lecturer Alasdair Ivens and the University of Edinburgh for the assessment brief and server environment  
- NCBI, EMBOSS, Clustal Omega, Biopython, and Bootstrap  
- Grok AI for assistance  

--