import random


def Generadorsorteos (azar):
    aleatorio=[]
    for i in range(azar):
        numero = random.randint(0, 999)
        formateado = str(numero).zfill(3)
        print(formateado)
        aleatorio.append(numero)
    return aleatorio
    
sorteos = (input("Digite los sorteos a simular"))
lista=Generadorsorteos(sorteos)
#print (lista)