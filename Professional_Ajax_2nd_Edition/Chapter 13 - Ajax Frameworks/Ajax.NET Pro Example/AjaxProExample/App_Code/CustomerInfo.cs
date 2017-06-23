using System;
using System.Data.SqlClient;

namespace Wrox
{

    public class CustomerInfo
    {

        [AjaxPro.AjaxMethod()]
        public string GetCustomerInfo(int id)
        {

            string info = "";
            string dataSourceName = @"localhost\SQLEXPRESS";
            string catalogName = "ProAjax";
            string connectString = String.Format(
                   "Data Source={0};Integrated Security=SSPI;Initial Catalog={1}",
                   dataSourceName, catalogName);
            string query = String.Format(
                   "Select * from Customers where CustomerId={0}", id);

            SqlConnection conn = null;
            SqlCommand command = null;

            try
            {
                conn = new SqlConnection(connectString);
                command = new SqlCommand(query, conn);

                conn.Open();
                SqlDataReader reader = command.ExecuteReader();
                if (reader.HasRows)
                {
                    reader.Read();
                    info = String.Format("{0}<br />{1}<br />{2}<br />{3}<br />{4}<br /><br />Phone: {5}<br /><a href=\"mailto:{6}\">{6}</a>",
                        reader.GetString(reader.GetOrdinal("Name")),
                        reader.GetString(reader.GetOrdinal("Address")),
                        reader.GetString(reader.GetOrdinal("City")),
                        reader.GetString(reader.GetOrdinal("State")),
                        reader.GetString(reader.GetOrdinal("Zip")),
                        reader.GetString(reader.GetOrdinal("Phone")),
                        reader.GetString(reader.GetOrdinal("Email"))
                    );
                }
                else
                {
                    info = String.Format("Customer with ID {0} doesn't exist.",
                                         id);
                }

                conn.Close();
            }
            catch (Exception ex)
            {
                info = "Error occurred while trying to connect to database: "
                          + ex.Message;
            }

            return info;
        }

    }
}
