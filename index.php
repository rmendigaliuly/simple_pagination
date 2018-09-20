<?php
	function set_default_nav () {
		global $first_page, $limit_of_links, $links;
		for ($i = 1; $i <= $limit_of_links; $i++) {
			if ($i == $first_page) $links[] = "index.php";
			else $links[] = "index.php?page=$i";
		} // endfor
	}

	function update_nav () {
		global $first_page, $current_page, $prev_page, $limit_of_links, $links, $pages_num;

		$counter = 0;
		$temp = $current_page;
		while ($temp - $limit_of_links > 0)
		{
			$counter++;
			$temp -= $limit_of_links;
		}

		for ($i = 1 + $counter * $limit_of_links; $i <= ($counter+1) * $limit_of_links; $i++) {
			if ($i == $first_page) $links[] = "index.php";
			elseif ($i <= $pages_num) $links[] = "index.php?page=$i";
		} //endfor
	}

	function get_pagination_nav () {
		global $first_page, $links, $prev_page, $next_page, $last_page, $current_page;
		$nav = "<nav><ul>";
		if (!is_null($first_page) && !is_null($current_page) && $current_page != $first_page)
		{
			$nav .= "<li><a href=\"index.php\">first</a></li>";
		}
		if (!is_null($prev_page) && !is_null($current_page) && $current_page != $prev_page)
		{
			$nav .= "<li><a href=\"index.php?page=$prev_page\">prev.</a></li>";
		}
		if (!empty($links))
		{
			foreach ($links as $key=>$link) {
				$nav .= "<li><a href=\"$link\"";
				if ($link = strstr($link, "page=")) {
					// strrpos -  Find the position of the last occurrence of a substring in a string
					while($temp = strrpos($link, "&")) $link = substr($link, 0, $temp);
					$link = substr($link,strpos($link,"=")+1);
					if (!is_null($current_page) && $current_page === $link) $nav .= "class=\"activeLink\"";
					$nav .= ">".$link;
				}
				else
				{
					if (!is_null($first_page) && $current_page === $first_page) $nav .= "class=\"activeLink\"";
					$nav .= ">".$first_page;
				}
				

				$nav .= "</a></li>";
			} // endfor
		} // endif
		if (!is_null($next_page))
		{
			$nav .= "<li><a href=\"index.php?page=$next_page\">next</a></li>";
		}
		if (!is_null($last_page) && !is_null($current_page) && $current_page != $last_page)
		{
			$nav .= "<li><a href=\"index.php?page=$last_page\">last</a></li>";
		}
		$nav .= "</ul></nav>";
		return $nav;
	}

	function get_content () {
		global $pages, $limit_of_content, $current_page, $prev_page;

		$content = "<article>";
		if (!is_null($prev_page))
		{
			for ($i = $prev_page*$limit_of_content; $i<$current_page*$limit_of_content; $i++)
			{
				if (isset($pages[$i])) $content .= "<section><h2>$i-section</h2><p><img src=\"images/$i.jpg\"></p><p>$pages[$i]</p></section>";
			} // endfor
		}
		else
		{
			for ($i = 0; $i<$current_page*$limit_of_content; $i++)
			{
				$content .= "<section><h2>$i-section</h2><p><img src=\"images/$i.jpg\"></p><p>$pages[$i]</p></section>";
			} // endfor
		}
		$content .= "</article>";
		return $content;
	}

	$limit_of_content = 1;
	$limit_of_links = 6;

	$pages = [
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet.",
		"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates iusto, repellat perferendis porro laboriosam, eaque omnis assumenda. Asperiores expedita eligendi quibusdam recusandae id eos officia, assumenda distinctio, soluta repellendus sequi cum, incidunt dolorum autem ex sit quasi a, voluptate itaque provident unde. Dolores sunt ratione quod accusamus! Soluta omnis magnam aliquid quo pariatur possimus eligendi, quia atque doloribus, error ad. Inventore dolore, velit, optio hic animi quia et, laudantium exercitationem ducimus numquam autem provident praesentium aperiam nostrum suscipit consectetur commodi? Accusantium itaque ipsum fuga ullam obcaecati iusto deleniti maxime aspernatur. Earum error asperiores ipsam, accusantium repellat tenetur, distinctio. Quae, amet."
	];
	
	$pages_num = ceil(count($pages) / $limit_of_content);
	if ($pages_num > 0) $first_page = 1;
	else $first_page = null;
	if ($pages_num >= 2) $last_page = $pages_num;
	else 
	{
		$last_page = null;
	}

	if (isset($_GET["page"]))
	{
		$req_page = $_GET["page"];
		if ((!is_null($first_page) && $req_page>=$first_page) || (!is_null($last_page) && $req_page<=$last_page))
		{
			$current_page = $req_page;
		}
		else
		{
			$current_page = null;
		}

		if (!is_null($first_page) && !is_null($current_page) && $current_page>$first_page) $prev_page = $current_page - 1;
		else $prev_page = null;
		if (!is_null($last_page) && !is_null($current_page) && $current_page+1<=$last_page) $next_page = $current_page + 1;
		else 
		{
			$next_page = null;
		}
	}
	else
	{
		if (!is_null($first_page))
		{
			$current_page = $first_page;
			$next_page = $current_page + 1;
		}
		else
		{
			$current_page = null;
			$next_page = null;
		}

		$prev_page = null;
	}

	$links = [];

	if (!is_null($current_page))
	{
		if ($current_page - $limit_of_links > 0)
		{
			update_nav();
		}
		else
		{
			set_default_nav();
		}
	}
	$pagination_nav = get_pagination_nav ();
	$content = get_content();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pagination</title>
	<style>
		.xdebug-var-dump font {
			color: white;
		}
		body {
			background: gray;
			font-size: 16px;
		}
		main {
			margin: 0 auto;
			max-width: 80%;
		}
		h1 {
			font-size: 3.5em;
			text-align: center;
			color: white;
		}
		section {
			background: white;
			padding: 10px;
			margin: 10px auto;
			font-size: 1.7em;
			border-radius: 5px;
		}
		section:first-of-type {
			margin-top: 10px;
		}
		section>h2 {
			font-size: 2.5em;
			color: #423f3f;
		}
		section img {
			width: 100%;
			border-radius: 7px;
		}
		ul {
			width: 90%;
			height: 50px;
			margin: 0;
			margin-top: 30px;
			padding: 0;
		}
		ul:after {
			display: table;
			clear: both;
			content: "";
		}
		li {
			float: left;
			background: white;
			list-style: none;
			margin-right: 10px;
			padding: 7px 5px 3px 5px;
			height: 30px;
			line-height: 1;
			border-radius: 5px;
		}
		li>a {
			text-decoration: none;
			color: black;
			font-size: 1.5em;
			line-height: 1;
		}
		li>a:hover {
			text-decoration: none;
			color: gray;
		}

		li>a.activeLink {
			color: #ff6356;
		}
		li>a.activeLink:hover {
			color: #f3aba5;
		}
	</style>
</head>
<body>
	<main>
		<h1>Simple Pagination</h1>
		<?php
		print $content;
		print $pagination_nav;
		?>
	</main>
</body>
</html>