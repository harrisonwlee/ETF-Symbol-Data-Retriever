from bs4 import BeautifulSoup
import requests, lxml, re
import sys, json

# try:
#     data = json.loads(sys.argv[1])
# except:
#     print "ERROR"
#     sys.exit(1)

symbol = "dia"
url = 'https://www.spdrs.com/product/fund.seam?ticker=' + symbol
r = requests.get(url)
html_content = r.text
soup = BeautifulSoup(html_content, "lxml")
soup = soup.find("div", {"id": "FUND_TOP_HOLDINGS"})
all_companies = soup.find_all("td", {"class": "label"})
companies = []

for elem in all_companies:
    companies.append(elem.text)
all_data = soup.find_all("td", {"class": "data"})
numbers = []

for elem in all_data:
    numbers.append(elem.text)

print json.dumps(companies)
print json.dumps(numbers)