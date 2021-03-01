import json

# load data
data = json.load(open("/home/cs143/data/nobel-laureates.json", "r"))
# data = json.load(open("nobel-laureates.json", "r"))

# get the id, givenName, and familyName of the first laureate
laureate = data["laureates"]
# laureate = json.dumps(laureate)

with open('laureates.import', 'w') as f:
    for i in laureate:
        content = json.dumps(i)
        f.write(content)
        f.write('\n')

print("successfully written to laureates.import")
