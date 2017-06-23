package wrox;
import java.sql.*;

public class CustomerInfo {

    public String getCustomerInfo(int id) {
        try {

            Class.forName("com.mysql.jdbc.Driver").newInstance();
            
            String dbservername = "localhost";
            String dbname = "your_db_name";
            String username = "your_user_name";
            String password = "your_password";
            String url = "jdbc:mysql://" + dbservername + "/" + dbname + "?user=" 
                         + username + "&password=" + password;

            Connection conn = DriverManager.getConnection(url);
			
			String sql = "Select * from Customers where CustomerId=" + id;
			Statement stmt = conn.createStatement();
			ResultSet rs = stmt.executeQuery(sql);			
			boolean found = rs.next();
			
			StringBuffer response = new StringBuffer();
			
			if (found) {        			    
                response.append(rs.getString("Name"));
                response.append("<br />");
                response.append(rs.getString("Address"));
                response.append("<br />");
                response.append(rs.getString("City"));
                response.append("<br />");
                response.append(rs.getString("State"));
                response.append("<br />");
                response.append(rs.getString("Zip"));
                response.append("<br /><br />");
                response.append("Phone: " + rs.getString("Phone"));
                response.append("<br /><a href=\"mailto:");
                response.append(rs.getString("Email"));
                response.append("\">");
                response.append(rs.getString("Email"));
                response.append("</a>");
			} else {
				response.append("Customer with ID ");
				response.append(id);
				response.append(" could not be found.");
			}
			
			rs.close();
			conn.close();

            return response.toString();

		} catch (Exception e){
			return "An error occurred while trying to get customer info.";
		}    
    }
}