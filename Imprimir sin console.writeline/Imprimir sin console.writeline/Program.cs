using System;


namespace ConsoleApp85
    {
        class Program
        {
            public static int[] Buscarrepeticion(int[] arr, int d)
            {
                int f = 0, e = 0;
                int[] arr2;
                while (arr.Length > f)
                {
                    if (arr[f] == d)
                    {
                        e++;
                    }
                    f++;
                }
                f = 0;
                arr2 = new int[e];
                e = 0;
                while (arr.Length > f)
                {
                    if (arr[f] == d)
                    {
                        arr2[e] = f + 1;
                        e++;
                    }
                    f++;
                }
                f = 0;
                //while(arr2.Length>f)
                //{
                //Console.WriteLine(arr2[f]);
                //f++;
                //}
                return arr2;
            }
            public static int BuscarPosicion(int[] arr, int d)
            {
                int f = 0, r = 0;
                while (arr.Length > f)
                {
                    if (arr[f] == d)
                    {
                        r = f;
                    }
                    f++;
                }
                return r + 1;
            }
            static void Main(string[] args)
            {
                int[] arreglo = { 1, 2, 3, 4, 5, 6, 7, 3, 9, 7, 3 };
                int num = 3;
                BuscarPosicion(arreglo, num);
                Buscarrepeticion(arreglo, num);

            }
        }
    }
