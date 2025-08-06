using System;

namespace OOPExercise
{
    public class Nurse : Person
    {
        public Nurse(string nombre, string app)
        {
            FirstName = nombre;
            LastName = app;
        }
        public override void Greet()
        {
            Console.WriteLine("Hello, I'm a Nurse!. My name is {0} {1}", FirstName , LastName);
        }
    }
}
