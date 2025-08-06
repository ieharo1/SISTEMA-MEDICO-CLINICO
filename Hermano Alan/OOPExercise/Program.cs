using System;
using System.Collections.Generic;

namespace OOPExercise
{
    class Program
    {
        /*Se necesita crear las clases Doctor y Patient. Ambas clases deben heredar de la
         * clase base (abstracta) Person. Las clases Nurse, Doctor y Patient deben tener un constructor
         * al cual acepte como parámetros 2 strings para inicializar sus propiedades FirstName y LastName.
         *
         * Cada una de las clases (Doctor, Patient y Nurse) deben tener su propia implementación del método Greet().
         * Por ejemplo. Si llamo al método Greet() de la clase Nurse, debe imprimirme el mensaje "Hello, I'm a Nurse. My name is {FirstName} + {LastName}".
         * Solo la clase Patient debe mostrar el mensaje que ya está definido en la clase Person y su propio mensaje.
         * Por ejemplo. Si llamo al método  Greet() de la clase Patient, debe mostrar los mesajes:
         *                                                                                          "Hello, I'm a person!"
         *                                                                                          "I'm a patient also! My name is {FirstName} + {LastName}".
         * Llenar la lista people creada en el método main con las clases Nurse, Doctor, Patient y Person.
         * Recorrer esta lista usando un foreach y llamar al método Greet() de cada elemento.
         */

        static void Main(string[] args)
        {
            var people = new List<IPerson>();
            Nurse Juana = new Nurse("Juana","Del ARCO");
            Doctor Ramrez = new Doctor("David", "Ramirez");
            Patient SUSY = new Patient("Susana", "Horia");

            people.Add(Juana);
            people.Add(Ramrez);
            people.Add(SUSY);

            foreach (var prueba in people) {
                prueba.Greet();
            }



            //Juana.Greet();
            //Juana.Caminar();
            //Julio.Greet();
            //Renato.Greet();
            /*add a Nurse*/
            //people.Add();
            /*add a Doctor*/
            //people.Add();
            /*add a Patient*/
            //people.Add();
            /*add a Person*/
            //people.Add();

            Console.ReadLine();
        }
    }
}
