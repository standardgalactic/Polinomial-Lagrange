
##### Created by 3rd group of PTI C class #####

#numpy library to use expand feature of array
import numpy as libnp

#ask amount of data from user
n = int(input("Masukkan jumlah data: "))

#defined array of x and y
x = libnp.zeros((n))
y = libnp.zeros((n))

#ask each data to store in x and y variable
for i in range(0,n):
    x[i] = float(input("Data x["+str(i)+"]: "))
    y[i] = float(input("Data y["+str(i)+"]: "))
    
#print data of array x and y    
print("\nData yang telah di-input")
for i in x:
    print("| %.4f "%(i), end = '')
print("")
for i in y:
    print("| %.4f "%(i), end = '')

#ask degree from user 
deg = int(input("\nMasukkan derajat yang ingin anda cari: "))

#ask interpolation value from user
xInter = float(input("Masukkan interpolasi x :"))

#operate the polynomial lagrange formula
yInter = 0
for i in range(0,deg):
    Li = 1
    for j in range(0,deg):
        if i != j:
            Li = float(Li) * (float(xInter)-float(x[j]))/(float(x[i])-float(x[j]))
    yInter = float(yInter) + float(Li) * float(y[i])

#print the result from the polynomial lagrange operation
print("\ninterpolasi: %.3f"% (yInter))

