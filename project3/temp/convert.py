import time
import pandas as pd
import numpy as np
import json
import pprint


def generate_row(li):
    res = ""
    for i in li:
        if type(i) == str and i != 'NULL':
            res += "\""+i+"\","
        else:
            res += str(i)+","
    res += '\n'
    return res

def try_append(key, dic, res, en):
    if key in dic:
        if en:
            res.append(dic[key]['en'])
        else:
            res.append(dic[key])
    else:
        res.append('NULL')
    return res

if __name__ == '__main__':
    start_time = time.time()
    with open("nobel-laureates.json", "r") as f:
        js = json.load(f)
    people_info = []
    org_info = []
    nobel_info = []
    affiliation_info = []
    for i in js['laureates']:
        if "orgName" in i.keys():
            info = []
            info.append(int(i['id']))
            info.append(i['orgName']['en'])
            if 'founded' not in i:
                info += ['NULL', 'NULL', 'NULL']
            else:
                info.append(i['founded']['date'])
                # info.append(i['founded']['place']['city']['en'])
                # info.append(i['founded']['place']['country']['en'])
                info = try_append('city', i['founded']['place'], info, True)
                info = try_append('country', i['founded']['place'], info, True)
            org_info.append(generate_row(info))
        else:
            info = []
            info.append(int(i['id']))
            info.append(i['givenName']['en'])
            info = try_append('familyName', i, info, True)
            info.append(i['gender'])
            if 'birth' not in i:
                info += ['NULL', 'NULL', 'NULL']
            else:
                info.append(i['birth']['date'])
                # info.append(i['birth']['place']['city']['en'])
                # info.append(i['birth']['place']['country']['en'])
                info = try_append('city', i['birth']['place'], info, True)
                info = try_append('country', i['birth']['place'], info, True)
            people_info.append(generate_row(info))
        count = 0
        for prize in i['nobelPrizes']:
            info = []
            info.append(int(i['id']))
            info.append(count)
            info.append(prize['awardYear'])
            info.append(prize['category']['en'])
            info.append(prize['sortOrder'])
            info.append(prize['portion'])
            info.append(prize['prizeStatus'])
            info = try_append('dateAwarded', prize, info, False)
            info.append(prize['motivation']['en'])
            info.append(prize['prizeAmount'])
            if 'affiliations' in prize:
                for aff in prize['affiliations']:
                    aff_info = []
                    aff_info.append(int(i['id']))
                    aff_info.append(count)
                    aff_info.append(aff['name']['en'])
                    aff_info = try_append('city', aff, aff_info, True)
                    aff_info = try_append('country', aff, aff_info, True)
                    affiliation_info.append(generate_row(aff_info))
            nobel_info.append(generate_row(info))
            count += 1
    print(people_info, org_info, nobel_info, affiliation_info, sep='\n')
    with open('people.del', 'w') as f1:
        f1.writelines(people_info)
    with open('organization.del', 'w') as f1:
        f1.writelines(org_info)
    with open('prize.del', 'w') as f1:
        f1.writelines(nobel_info)
    with open('affiliation.del', 'w') as f1:
        f1.writelines(affiliation_info)
    print('======= Time taken: %f =======' % (time.time() - start_time))