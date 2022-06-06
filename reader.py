new_line = []
base_line = "<p>投稿者:</p><p>内容:</p><p></p><input type='button' name='' value='削除'>"

with open('test.txt') as f:
    line = f.readline()
    while line:
        line = line.rstrip()
        # print(line)
        if((base_line in line) == False):
            # print("XXX")
            new_line.append(str(line + "\n"))

        line = f.readline()


print()
for i in range(len(new_line)):
    # print(new_line[i])
    print()

print(new_line)

f = open('test.txt', 'w')

f.writelines(new_line)

f.close()
