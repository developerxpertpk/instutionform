using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace calculator_c_sharp
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }


        private decimal frstnmber = 0.0m;
        private decimal scndnmber = 0.0m;
        private decimal result = 0;
        private int operatorType = (int)Mathsoperations.NoOperator;
        public enum Mathsoperations
        {
            NoOperator = 0,
            Add = 1,
            Minus = 2,
            multiply = 3,
            Divide = 4,
            percentage = 5


        }

        private void button17_Click(object sender, EventArgs e)
        {
            displaytextBox.Text = displaytextBox.Text + "0";
        }

        private void button1_Click(object sender, EventArgs e)
        {
            if (displaytextBox.Text == "0")
            {
                displaytextBox.Clear();

            }
            displaytextBox.Text = displaytextBox.Text + "1";
        }

        private void button8_Click(object sender, EventArgs e)
        {
            if (displaytextBox.Text == "0")
            {
                displaytextBox.Clear();

            }
            displaytextBox.Text = displaytextBox.Text + "3";
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (displaytextBox.Text == "0")
            {
                displaytextBox.Clear();

            }
            displaytextBox.Text = displaytextBox.Text + "2";
        }

        private void button7_Click(object sender, EventArgs e)
        {
            if (displaytextBox.Text == "0")
            {
                displaytextBox.Clear();

            }
            displaytextBox.Text = displaytextBox.Text + "4";
        }

        private void button6_Click(object sender, EventArgs e)
        {
            if (displaytextBox.Text == "0")
            {
                displaytextBox.Clear();

            }
            displaytextBox.Text = displaytextBox.Text + "5";
        }

        private void button5_Click(object sender, EventArgs e)
        {
            if (displaytextBox.Text == "0")
            {
                displaytextBox.Clear();

            }
            displaytextBox.Text = displaytextBox.Text + "6";
        }

        private void button4_Click(object sender, EventArgs e)
        {
            if (displaytextBox.Text == "0")
            {
                displaytextBox.Clear();

            }
            displaytextBox.Text = displaytextBox.Text + "7";
        }

        private void button3_Click(object sender, EventArgs e)
        {
            if (displaytextBox.Text == "0")
            {
                displaytextBox.Clear();

            }
            displaytextBox.Text = displaytextBox.Text + "8";
        }

        private void button9_Click(object sender, EventArgs e)
        {
            if (displaytextBox.Text == "0")
            {
                displaytextBox.Clear();

            }
            displaytextBox.Text = displaytextBox.Text + "9";
        }

        private void button12_Click(object sender, EventArgs e)
        {
            savevalueAndOperatorType((int)Mathsoperations.Add);
        }

        private void button15_Click(object sender, EventArgs e)
        {
            savevalueAndOperatorType((int)Mathsoperations.Minus);
        }

        private void button14_Click(object sender, EventArgs e)
        {
            savevalueAndOperatorType((int)Mathsoperations.multiply);
        }

        private void button13_Click(object sender, EventArgs e)
        {
            savevalueAndOperatorType((int)Mathsoperations.Divide);
        }

        private void button19_Click(object sender, EventArgs e)
        {
            savevalueAndOperatorType((int)Mathsoperations.percentage);
        }

        private void button16_Click(object sender, EventArgs e)
        {
            scndnmber = Convert.ToDecimal(displaytextBox.Text);

            switch (operatorType)
            {
                case (int)Mathsoperations.Add:
                    result = frstnmber + scndnmber;
                    break;
                case (int)Mathsoperations.Minus:
                    result = frstnmber - scndnmber;
                    break;
                case (int)Mathsoperations.multiply:
                    result = frstnmber * scndnmber;
                    break;
                case (int)Mathsoperations.Divide:
                    result = frstnmber / scndnmber;
                    break;
                case (int)Mathsoperations.percentage:
                    result = (scndnmber * 100) / frstnmber;
                    break;
            }

            displaytextBox.Text = result.ToString();
        }


        private void savevalueAndOperatorType(int operation)
        {
            operatorType = operation;
            frstnmber = Convert.ToDecimal(displaytextBox.Text);
            displaytextBox.Text = "0";


        }

        private void button10_Click(object sender, EventArgs e)
        {
            displaytextBox.Text = "0";
            frstnmber = 0.0m;
            scndnmber = 0.0m;
            result = 0.0m;
            operatorType = (int)Mathsoperations.NoOperator;
        }

    

        

        
    }
}

        
