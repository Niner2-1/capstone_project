def process_list(numbers):
  output = []
  alphabet = "abcdefghijklmnopqrstuvwxyz"
  for number in numbers:
    newlist = list(alphabet[:number])
    output.append(newlist)
  return output

input = [3, 8, 4]
output = process_list(input)
print(output)