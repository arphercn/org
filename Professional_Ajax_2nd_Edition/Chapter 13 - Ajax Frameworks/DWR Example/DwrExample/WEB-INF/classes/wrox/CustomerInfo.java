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
			
			String sql = "Select * from Customers where CustomerId=" + customerId;
			Statement stmt = conn.createStatement();
			ResultSet rs = stmt.executeQuery(sql);			
			boolean found = rs.next();
			
			StringBuffer response = new StringBuffer();
			
			if (found) {        			    
                message.append(rs.getString("Name"));
                message.append("<br />");
                message.append(rs.getString("Address"));
                message.append("<br />");
                message.append(rs.getString("City"));
                message.append("<br />");
                message.append(rs.getString("State"));
                message.append("<br />");
                message.append(rs.getString("Zip"));
                message.append("<br /><br />");
                message.append("Phone: " + rs.getString("Phone"));
                message.append("<br /><a href=\"mailto:");
                message.append(rs.getString("Email"));
                message.append("\">");
                message.append(rs.getString("Email"));
                message.append("</a>");
			} else {
				response.append("Customer with ID ");
				response.append(customerId);
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