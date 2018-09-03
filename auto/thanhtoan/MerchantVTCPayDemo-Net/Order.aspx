<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Order.aspx.cs" Inherits="WebSitePayment.Order" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Sample paygate</title>
    <style type="text/css">
        .style1 {
            height: 18px;
        }
    </style>
</head>
<body>
    <form id="form1" runat="server">
        <div>

            <table>

                <tr>
                    <td>Hệ thống
                    </td>
                    <td>
                        <asp:DropDownList ID="ddlEnvinroment" runat="server" AutoPostBack="True" OnSelectedIndexChanged="ddlEnvinroment_SelectedIndexChanged">
                            <asp:ListItem Text="Sandbox" Value="http://alpha1.vtcpay.vn/portalgateway/checkout.html"></asp:ListItem>
                            <asp:ListItem Text="Live" Value="https://vtcpay.vn/bank-gateway/checkout.html"></asp:ListItem>
                        </asp:DropDownList>
                    </td>
                </tr>

                <tr>
                    <td>Mã website
                    </td>
                    <td>
                        <asp:TextBox ID="txtWebsiteID" runat="server" Text="5023"></asp:TextBox>
                    </td>
                </tr>

                <tr>
                    <td>Giá trị đơn hàng:
                    </td>
                    <td>
                        <asp:TextBox ID="txtTotalAmount" runat="server" Text="10000"></asp:TextBox>
                    </td>
                </tr>

                <tr>
                    <td>Tài khoản nhận
                    </td>
                    <td>
                        <asp:TextBox ID="txtReceiveAccount" runat="server" Text="0963465816"></asp:TextBox>
                    </td>
                </tr>

                <tr>
                    <td class="style1">Đơn vị thanh toán:
                    </td>
                    <td class="style1">
                        <asp:DropDownList ID="ddlCurrency" runat="server">
                            <asp:ListItem Text="VND" Selected="True" Value="VND"></asp:ListItem>
                            <asp:ListItem Text="USD" Value="USD"></asp:ListItem>
                        </asp:DropDownList>
                    </td>
                </tr>

                <tr>
                    <td>Mã đơn hàng
                    </td>
                    <td>
                        <asp:TextBox ID="txtOrderID" runat="server" Text="123456">
                        </asp:TextBox>
                    </td>
                </tr>




                <tr>
                    <td></td>
                    <td>
                        <asp:Button ID="Button1" runat="server" Text="Thanh toán đơn hàng" OnClick="Button1_Click"
                            Width="188px" />
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <asp:Label ID="Label1" runat="server"></asp:Label></td>
                </tr>

            </table>
        </div>
    </form>
</body>
</html>
